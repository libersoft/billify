<?php

Interface  ICashFlowAdapter {
   public function getDate();
   public function getDescription();
   public function getImponibile();
   public function getImposte();
   public function getTotale();
   public function getModelId();
   public function getModelClass();
}
?>