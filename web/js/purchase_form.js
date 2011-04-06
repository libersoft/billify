$(document).ready(function() {
  
  get_data_stato_row().toggleClass('hiddenrow', !is_pagata_selected());

  $('#fattura_stato').change(function(){
    get_data_stato_row().toggleClass('hiddenrow', !is_pagata_selected());
  });

});

function get_data_stato_row() {

  return $('#fattura_data_stato_year').parent().parent();
}

function is_pagata_selected() {
  
  return $('#fattura_stato option:selected').val() == 'p';
}