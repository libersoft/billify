<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<customerinfo>
  <request>
    <auth>0</auth>
    <status>0</status>
  </request>
  <customer>
    <company><?php echo $customer->getRagioneSociale()?></company>
    <contact_name><?php echo $customer->getCognome()?> <?php echo $customer->getNome()?></contact_name>
    <address><?php echo $customer->getVia()?></address>
    <city><?php echo $customer->getCitta()?></city>
    <state><?php echo $customer->getProvincia()?></state>
    <zip><?php echo $customer->getCap()?></zip>
    <country>Italia</country>
    <email><?php echo $customer->getEmail()?></email>
    <fax><?php echo $customer->getFax()?></fax>
    <phone><?php echo $customer->getTelefono()?></phone>
    <company_code><?php echo $customer->getPiva()?></company_code>
    <personal_code><?php echo $customer->getCF()?></personal_code>
</customer>
</customerinfo>