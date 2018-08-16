// ENWルールに則ってリセットします

$(function (){
  $('li:first-child').addClass('first');
  $('li:last-child').addClass('last');
  $('li:even').addClass('even');
  $('tr:even').addClass('even');
});