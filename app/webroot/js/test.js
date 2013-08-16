/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//alert('Day');
$('.carousel').carousel();
var bootstrapButton = $.fn.button.noConflict(); // return $.fn.button to previously assigned value
$.fn.bootstrapBtn = bootstrapButton;            // give $().bootstrapBtn the bootstrap functionality