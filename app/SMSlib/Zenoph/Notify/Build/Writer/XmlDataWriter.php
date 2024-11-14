<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    namespace Zenoph\Notify\Build\Writer;
    
    use \XMLWriter;
    
    use Zenoph\Notify\Utils\MessageUtil;
    use Zenoph\Notify\Utils\RequestUtil;
    use Zenoph\Notify\Enums\DestinationMode;
    use Zenoph\Notify\Enums\MessageCategory;
    use Zenoph\Notify\Store\PersonalisedValues;
    use Zenoph\Notify\Build\Writer\DataWriter;
    use Zenoph\Notify\Compose\Composer;
    use Zenoph\Notify\Compose\SMSComposer;
    use Zenoph\Notify\Compose\MessageComposer;
    use Zenoph\Notify\Compose\VoiceComposer;
    
    class XmlDataWriter extends DataWriter {
        const __DATA_PLACEHOLDER__ = '%dataPH%';
        private $_REQ_STR_TPL__ = null;
        private $_requestBody = null;
        
        public function __construct() {
            parent::__construct();
            
            $this->_REQ_STR_TPL__ = "<request>".self::__DATA_PLACEHOLDER__."</request>";
                
            // set request body to the template
            $this->_requestBody = $this->_REQ_STR_TPL__;
        }
        
        private static function initXmlWriter(){
            $writer = new XMLWriter();
            $writer->openMemory();
            
            return $writer;
        }
    
        public function &writeSMSRequest(SMSComposer $sc) {
            // create xmlWriter and start writing
            $writer = self::initXmlWriter();

            // write message properties
            $this->writeSMSProperties($sc, $writer);

            // write messagedestinations
            $this->writeDestinations($sc, $writer);
            
            // get fragment and embed in request body
            $xmlFragment = $writer->outputMemory();
            $this->_requestBody = str_replace(self::__DATA_PLACEHOLDER__, $xmlFragment, $this->_requestBody);
            
            // return request body
            return $this->_requestBody;
        }
        
        private function writeSMSProperties(SMSComposer $sc, \XMLWriter $xmlWriter){
            $messageText = $sc->getMessage();
            $messageType = $sc->getSMSType();

            $xmlWriter->writeElement('text', $messageText);
            $xmlWriter->writeElement('type', $messageType);
            $xmlWriter->writeElement('sender', $sc->getSender());
            
            if (SMSComposer::getMessageVariablesCount($messageText) > 0){
                if (!$sc->personalise())
                    $xmlWriter->writeElement ('personalise', "false");
            }
      
            // message properties common to both text and voice messages
            $this->writeCommonMessageProperties($sc, $xmlWriter);
        }

        public function &writeVoiceRequest(VoiceComposer $vc) {
            // begin writing
            $xmlWriter = self::initXmlWriter();

            // write message properties
            $this->writeVoiceProperties($vc, $xmlWriter);

            // write destinstions
            $this->writeDestinations($vc, $xmlWriter);
            
            // output
            $xmlData = $xmlWriter->outputMemory();
            $this->_requestBody = str_replace(self::__DATA_PLACEHOLDER__, $xmlData, $this->_requestBody);
            
            // return request body
            return $this->_requestBody;
        }
        
        private function writeVoiceProperties(VoiceComposer $vc, $writer){
            $sender = $vc->getSender();
            $tplRef = $vc->getTemplateReference();
            
            // If not offline audio, then tplRef must be available
            if (!$vc->isOfflineAudio()){
                if (is_null($tplRef) || empty($tplRef))
                    throw new \Exception('Template reference has not been set for writing voice message request.');
            }
            
            if (!is_null($tplRef) || !empty($tplRef))
                $writer->writeElement('template', $tplRef);
            
            if (!is_null($sender) && !empty($sender))
                $writer->writeElement('sender', $sender);
            
            // common message properties
            $this->writeCommonMessageProperties($vc, $writer);
        }
        
        protected function writeCommonMessageProperties(MessageComposer $mc, &$writer) {
            // if message is to be scheduled
            if ($mc->schedule()){
                $scheduleInfo = $mc->getScheduleInfo();
                $this->writeScheduleInfo($scheduleInfo[0], $scheduleInfo[1], $writer);
            }
            
            if ($mc->notifyDeliveries()){
                $notifyInfo = $mc->getDeliveryCallback();
                $this->writeCallbackInfo($notifyInfo[0], $notifyInfo[1], $writer);
            }
        }
        
        protected function writeDestinations(Composer $mc, &$writer) {
            $compDestsList = $mc->getDestinations();
            
            // it shouldn't be empty
            if ($compDestsList->getCount() == 0)
                throw new \Exception('There are no message destinations for writing.');
            
            // start writing
            $writer->startElement('destinations');
            
            foreach ($compDestsList as $compDest){
                if ($compDest->getWriteMode() == DestinationMode::DM_NONE)
                    continue;
                
                $phoneNumber = $compDest->getPhoneNumber();
                
                if ($mc instanceof MessageComposer)
                    $mc->validateDestinationSenderName($phoneNumber);
                
                // get other values
                $messageId = $compDest->getMessageId();
                $destData  = $compDest->getData();
                
                // write destination item
                $this->writeDestinationItem($phoneNumber, $messageId, $destData, $writer);
            }
            
            $writer->endElement();  // end destinations element
        }
        
        private function writeDestinationItem(?string $phoneNumber, ?string $messageId, $destData, $writer){
            if ((is_null($phoneNumber) || empty($phoneNumber)) && (is_null($messageId) || empty($messageId)))
                throw new \Exception('Phone number and message identifier must not be for writing destination item.');
        
            if (is_null($messageId) && is_null($destData))
                $writer->writeElement('to', $phoneNumber);
            else {
                // writer start of [to] element
                $writer->startElement('to');
                
                // write the destination object data
                $this->writeDestinationItemWithData ($phoneNumber, $messageId, $destData, $writer);
                    
                // write end of [to] element
                $writer->endElement();
            }
        }
        
        private function writeDestinationItemWithData(?string $phoneNumber, ?string $messageId, $destData, $writer){
            // write the destination phone number, if provided
            if (!is_null($phoneNumber) && !empty($phoneNumber))
                $writer->writeElement('number', $phoneNumber);

            // If message Id is available, write it
            if (!is_null($messageId) && !empty($messageId))
                $writer->writeElement('id', $messageId);

            if ($destData instanceof PersonalisedValues)
                $this->writeDestinationPersonalisedValues($destData, $writer);
        }
        
        private function writeDestinationPersonalisedValues(PersonalisedValues $pv, $writer){
            $writer->startElement('values');
                foreach ($pv as $value){
                    $writer->writeElement('value', $value);
                }
            $writer->endElement();  // end values element
        }
        
        protected function writeScheduleInfo($dateTime, $utcOffset, &$writer) {
            $this->validateScheduleInfo($dateTime, $utcOffset);
            
            $writer->startElement('schedule');
                $writer->writeElement('dateTime', MessageUtil::dateTimeToStr($dateTime));
                
                // If there is UTC offset, write it
                if (!is_null($utcOffset) && !empty($utcOffset))
                    $writer->writeElement('offset', $utcOffset);
            $writer->endElement();   // end schedule element
        }
        
        protected function writeCallbackInfo($url, $contentType, &$writer) {
            $this->validateDeliveryNotificationInfo($url, $contentType);
            
            // write
            $writer->startElement('callback');
                $writer->writeElement('url', $url);
                $writer->writeElement('accept', RequestUtil::getDataContentTypeLabel($contentType));
            $writer->endElement();   // end notify element
        }
        
        public function &writeDestinationsData($mc) {
            if (is_null($mc))
                throw new \Exception('Invalid reference to message object for writing destinations.');
            
            // initialise xmlwriter
            $xmlWriter = self::initXmlWriter();
            
            // write destinations
            $this->writeDestinations($mc, $xmlWriter);
            
            // get and write xml fragment in request body
            $xmlFragment = $xmlWriter->outputMemory();
            $this->_requestBody = str_replace(self::__DATA_PLACEHOLDER__, $xmlFragment, $this->_requestBody);
            
            // return request body string
            return $this->_requestBody;
        }
        
        public function &writeDestinationsDeliveryRequest($messageIdsArr) {
            if (is_null($messageIdsArr) || !is_array($messageIdsArr))
                throw new \Exception('Invalid reference for writing message identifiers.');
            
            if (count($messageIdsArr) == 0)
                throw new \Exception('There are no message identifiers for writing destination delivery request.');
            
            $xmlWriter = self::initXmlWriter();

            // write message Ids
            $xmlWriter->startElement('destinations');
            
            foreach ($messageIdsArr as $messageId){
                if (!is_null($messageId) && !empty($messageId))
                    $xmlWriter->writeElement('id', $messageId);
            }
            
            $xmlWriter->endElement();   // end destinations element
            
            // prepare output
            $xmlFragment = $xmlWriter->outputMemory();
            $this->_requestBody = str_replace(self::__DATA_PLACEHOLDER__, $xmlFragment, $this->_requestBody);
            
            // return request body
            return $this->_requestBody;
        }
        
        public function &writeScheduledMessagesLoadRequest($filter) {
            $this->validateScheduledMessagesLoadData($filter);
            
            // embed auth details now
        //    $this->embedAuthData();
            $xmlWriter = self::initXmlWriter();
            
            // If templateId is specified, then we should load specific message
            $batchId = $filter['batch'];
            
            // write message element
        //    $xmlWriter->startElement('message');
            
            if (!is_null($batchId) && !empty($batchId)){
                $this->writeMessageBatchId($batchId, $xmlWriter);
            }
            else {  // not specific
                if (!is_null($filter['category']))
                    $xmlWriter->writeElement('category', $filter['category']);
                
                // if there are dates specified
                if (!is_null($filter['dateFrom']) && !is_null($filter['dateTo'])){
                    $xmlWriter->startElement('dateTime');
                        $xmlWriter->writeElement('from', MessageUtil::dateTimeToStr($filter['dateFrom']));
                        $xmlWriter->writeElement('to', MessageUtil::dateTimeToStr($filter['dateTo']));
                        
                        // If UTC offset is specified, then we write it
                        if (!is_null($filter['offset']) && !empty($filter['offset']))
                            $xmlWriter->writeElement('offset', $filter['offset']);
                        
                    $xmlWriter->endElement();   // end dateTime element
                }
            }
            
            // end message element
        //    $xmlWriter->endElement();
            
            // prepare output
            $xmlFragment = $xmlWriter->outputMemory();
            $this->_requestBody = str_replace(self::__DATA_PLACEHOLDER__, $xmlFragment, $this->_requestBody);
            
            // return request body
            return $this->_requestBody;
        }
        
        public function &writeScheduledMessageUpdateRequest($mc) {
            if (is_null($mc) || $mc instanceof MessageComposer === false)
                throw new \Exception('Invalid object reference for writing scheduled message update request.');
            
        //    $this->embedAuthData();
            $xmlWriter = self::initXmlWriter();
            $category = $mc->getCategory();
            
            // begin writing
        //    $xmlWriter->startElement('message');
            //    $this->writeMessageBatchId($mc->getBatchId(), $xmlWriter);
                
                // message properties to be written will depend on the category
                if ($category == MessageCategory::SMS || $category == MessageCategory::USSD)
                    $this->writeSMSProperties ($mc, $xmlWriter);
                else /// voice message then
                    $this->writeVoiceProperties ($mc, $xmlWriter);
                
                // see if there are destinations to be written
                if ($mc->getDestinationsCount() > 0)
                    $this->writeScheduledMessageDestinations($mc, $xmlWriter);
                
        //    $xmlWriter->endElement();   // end message element
            
            // prepare output
            $xmlFragment = $xmlWriter->outputMemory();
            $this->_requestBody = str_replace(self::__DATA_PLACEHOLDER__, $xmlFragment, $this->_requestBody);
            
            // return request body
            return $this->_requestBody;
        }
        
        private function writeScheduledMessageDestinations($mc, $xmlWriter){
            // get the destinations
            $compDestsList = $mc->getDestinations();
            
            if (is_null($compDestsList) || $compDestsList->getCount() == 0)
                return;
            
            // individual writers for adding, updating, and deleting destinations
            $addWriter = self::initXmlWriter();
            $updateWriter = self::initXmlWriter();
            $deleteWriter = self::initXmlWriter();
            
            foreach ($compDestsList as $compDest){
                $destMode = $compDest->getWriteMode();
                
                // if destination mode is NONE, we will not write
                if ($destMode == DestinationMode::DM_NONE)
                    continue;
                
                $phoneNumber = $compDest->getPhoneNumber();
                $mc->validateDestinationSenderName($phoneNumber);
                
                // other data
                $destData = $compDest->getData(); 
                $messageId = $compDest->getMessageId();
                
                switch ($destMode){
                    case DestinationMode::DM_ADD:
                        $this->writeDestinationItem($phoneNumber, $messageId, $destData, $addWriter);
                        break;
                    
                    case DestinationMode::DM_UPDATE:
                        $this->writeDestinationItem($phoneNumber, $messageId, $destData, $updateWriter);
                        break;
                    
                    case DestinationMode::DM_DELETE:
                        $this->writeDestinationItem(null, $messageId, null, $deleteWriter);
                        break;
                }
            }
            
            // get individual writer fragments
            $addXml = $addWriter->outputMemory();
            $updateXml = $updateWriter->outputMemory();
            $deleteXml = $deleteWriter->outputMemory();
            
            $xmlWriter->startElement('destinations');
            
            // begin writing
            if (!is_null($addXml) && !empty($addXml)) {
                $xmlWriter->startElement('add');
                $xmlWriter->writeRaw($addXml);
                $xmlWriter->endElement();   // end add element
            }
            
            if (!is_null($updateXml) && !empty($updateXml)){
                $xmlWriter->startElement('update');
                $xmlWriter->writeRaw($updateXml);
                $xmlWriter->endElement();   // end update element
            }
            
            if (!is_null($deleteXml) && !empty($deleteXml)){
                $xmlWriter->startElement('delete');
                $xmlWriter->writeRaw($deleteXml);
                $xmlWriter->endElement();   // end delete element
            }
            
            // end destinations element
            $xmlWriter->endElement();
        }
        
        public function &writeUSSDRequest($ucArr) {
            
        }
        
        private function writeUSSDData($tmc, $xmlWriter){
            // in future implementation
        }
        
        private function writeMessageBatchId(string $batchId, $xmlWriter){
            $xmlWriter->writeElement('batch', $batchId);
        }
    }