<?php

/**
 * xmlrpc actions.
 *
 * @package    sf_sandbox
 * @subpackage xmlrpc
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */

require_once 'XML/RPC2/Server.php';
include_once('propel/util/Criteria.php');

class xmlrpcActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {	
  	
  	//$server = XML_RPC2_Server::create('xmlRpcExportModel', array('backend'=>'php','encoding'=>'utf-8'));
	  //$server->handleCall();
	  $username = 'trucchia';
	  $password = 'Mfonte41';
	  
	  $clienti = unserialize(file_get_contents('/tmp/clienti_serialize'));
	  $import = new importModel();
	   
	  foreach ($clienti as $cliente) {
	     $id = $import->importCliente($cliente['cliente'], $username, $password);
	     foreach ($cliente['fatture'] as $fattura) {
	       $id_fattura = $import->importFattura($fattura['fattura'], $id, $username, $password);
	       
	       foreach ($fattura['dettagli'] as $dettaglio) {
	         $import->importDettagliFattura($dettaglio, $id_fattura, $username, $password);
	       }
	     }
	  }
	  
	return sfView::NONE;
  }

  public function executeProva(){
  	$prova = new xmlRpcExportModel();
	   $prova->importCliente(array(),'trucchia','Mfonte41');

	return sfView::NONE;
  }
  
}

Class importModel{
	
	/**
	 * Importa la lista dei clienti
	 *
	 * @param array Cliente
	 * @param string Username
	 * @param string Password
	 * @return string Ciao
	 */
	public static function importCliente($cliente,$username, $password){
		$criteria = new Criteria();
  	$criteria->add(UtentePeer::USERNAME, $username);
  	$criteria->add(UtentePeer::PASSWORD , md5($password));
  	
  		$utente = UtentePeer::doSelectOne($criteria);
		$count = 0;
		$c = new Criteria();
		$c->add(ModoPagamentoPeer::ID_UTENTE, $utente->getId());
		$modo_pagamento = ModoPagamentoPeer::doSelectOne($c);

		if (!is_null($utente) && $utente->getStato() != 'disattivo' && $utente->getTipo() != "demo"){
				$cliente_new = new Cliente();
				$cliente_new->fromArray($cliente);
				$cliente_new->setIdUtente($utente->getId());
				$cliente_new->setModoPagamentoId($modo_pagamento->getId());
				//$cliente_new->setId($cliente['Id']);
				$cliente_new->save();
				return $cliente_new->getId();
		}
		return 'false';
	}
	
	/**
	 * Importa la lista delle fattura
	 *
	 * @param array Fattura
	 * @param int id_cliente
	 * @param string Username
	 * @param string Password
	 * @return string String
	 */
	public static function importFattura($fattura,$id_cliente, $username, $password){
		$criteria = new Criteria();
  		$criteria->add(UtentePeer::USERNAME, $username);
  		$criteria->add(UtentePeer::PASSWORD , md5($password));
  	
  		$utente = UtentePeer::doSelectOne($criteria);
		if (!is_null($utente) && $utente->getStato() != 'disattivo'  && $utente->getTipo() != "demo"){

		$criteria->clear();
		$criteria->add(ModoPagamentoPeer::NUM_GIORNI, $fattura['num_giorni']);
		$modo_pagamento = ModoPagamentoPeer::doSelectOne($criteria);

				$fattura_new = new Fattura();
				$fattura_new->fromArray($fattura);
				$fattura_new->setClienteId($id_cliente);
				$fattura_new->setIdUtente($utente->getId());
				if($modo_pagamento)
				  $fattura_new->setModoPagamentoId($modo_pagamento->getId());
				else
				  $fattura_new->setModoPagamentoId(13);
				$fattura_new->save();
				return $fattura_new->getId();
		}
		return 'false';
		
	}
	
	/**
	 * Importa la lista dei dettagli fattura
	 *
	 * @param array DettaglioFattura
	 * @param int id_fattura
	 * @param string Username
	 * @param string Password
	 * @return string String
	 */
	public static function importDettagliFattura($dettaglio_fattura,$id_fattura, $username, $password){
		$criteria = new Criteria();
  		$criteria->add(UtentePeer::USERNAME, $username);
  		$criteria->add(UtentePeer::PASSWORD , md5($password));
  	
  		$utente = UtentePeer::doSelectOne($criteria);
		if (!is_null($utente) && $utente->getStato() != 'disattivo'  && $utente->getTipo() != "demo"){
				$dettaglio_new = new DettagliFattura();
				$dettaglio_new->fromArray($dettaglio_fattura);
				$dettaglio_new->setFatturaId($id_fattura);
				$dettaglio_new->save();
				return 'true';
		}
		return 'false';
	}
}
