$(document).ready(function(){

  "use strict";

  $(".filter-toggle").click(function(){
    if($(".filter-dropdown").hasClass("hide"))
      $(".filter-dropdown").removeClass("hide").addClass("show");
    else
      $(".filter-dropdown").removeClass("show").addClass("hide");
  });

  $(".filter-dropdown .item").click(function(){
    let $this = $(this);
    let old_content = $(".filter-toggle .selected-item").text();
    let old_filter = $(".filter-toggle .selected-item").attr("data-filter");
    let new_content = $this.text();
    let new_filter = $this.attr("data-filter");
    $($(".filter-toggle .selected-item").text(new_content));
    $(".filter-toggle .selected-item").attr("data-filter", new_filter);
    $this.text(old_content);
    $this.attr("data-filter", old_filter);
  });

  $(".big-add-box").click(function(){
    $(".overlay").show();
  });

  $(".close-box").click(function(){
      $(".overlay").fadeOut();
  });
});

$(document).on("click", ".accordion-toggle", function(){
  const $this = $(this);
  if($this.hasClass("closed")){
    $this.siblings(".accordion-content").show();
    $this.removeClass("closed").addClass("opened");
    $(this).find(".icon-toggle").removeClass("mdi-menu-right").addClass("mdi-menu-down");
    $(this).parent().addClass("shadow");
  }
  else{
    $this.siblings(".accordion-content").hide();
    $this.removeClass("opened").addClass("closed");
    $this.children(".icon-toggle").attr("class", "mdi mdi-menu-right");
    $(this).find(".icon-toggle").removeClass("mdi-menu-down").addClass("mdi-menu-right");
  }
});

$(document).on("click", ".delete-btn", function(e){
  e.stopPropagation();
});

$(document).on("click", ".course-box", function(e){
  if( !e.ctrlKey ){
    $(".course-box").each(function(){
      if( $(this).hasClass("selected") ) $(this).removeClass("selected");
    });
    $(this).addClass("selected");
  } else{
    $(this).addClass("selected");
  }
});

$(document).on("click", function(e){
  $this = $(e.target);
  if( $(".overlay").show() && !$this.hasClass("big-add-box") ){
    if( !$this.parents().hasClass("overlay") ){
      $(".overlay").hide();
    }
  }
});
