$(document).ready(() => {
    const $menuButton = $('.submit-btn2');
    const $navDropdown = $('.response-form');
    $menuButton.on('click',()=>{
      $navDropdown.hide();
      $('.booking-confirm').fadeIn(900);
    });
    
  
  
  });