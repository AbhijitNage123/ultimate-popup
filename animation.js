jQuery(window).load(function () {
  jQuery(".trigger_popup_fricc").click(function(){
    jQuery('.hover_bkgr_fricc').show();
  });
  jQuery('.hover_bkgr_fricc').click(function(){
    jQuery('.hover_bkgr_fricc').hide();
  });
  jQuery('.popupCloseButton').click(function(){
    jQuery('.hover_bkgr_fricc').hide();
  });
});