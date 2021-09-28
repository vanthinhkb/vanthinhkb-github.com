$("body").on("click", ".control-list__item", function () {
  $(this).addClass("active");
  $(this).siblings().removeClass("active");
  $($(this).attr("tab-show")).slideDown(300);
  $($(this).attr("tab-show")).siblings().slideUp(300);
  $(this).parents(".tab-control").find(".control__show").html($(this).html());
  $(this).parents(".itemSidebar").removeClass("active");
  $(this).parents(".tab-control").find(".control__show").removeClass("active");
});
$("body").on("click", ".control__show", function () {
  $(".itemSidebar").addClass("active");
  $(this).toggleClass("active");
});
