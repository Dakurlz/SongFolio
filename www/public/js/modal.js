// $(document).on('ready', handler());
// alert($('body'));

$(document).ready(() => {
  $("header").css("transition", "all 0.6s");

  hideSection();
  showSections();

  $(".cta-button").click(e => {
    showModal(e);
  });

  $(".cta-button").removeAttr("href");

  $(window).scroll(() => {
    showSections();
    let windowsPosition = $(window).scrollTop();

    if (windowsPosition > 0) $("header").addClass("sticky");
    else $("header").removeClass("sticky");
  });
});

// function hideSection()
// 1 masquer les section directement enfans de main
// 2 ajouter un ecouteur de scroll sur la windows
// 3 les sections appareissent lorsque

const hideSection = () => {
  $("main > section").css("opacity", "0");
  $("main > section").each(function() {
    $(this).css("opacity", "0");
    $(this).css("transition", "all 0.6s");
    $(this).css("position", "relative");
    $(this).css("top", "5rem");
  });
};

const showSections = () => {
  // calculer la position par apport de heut de la fenetre
  // si cette posittion est < a 70 % la heuteur de la fenetre
  // alors la section en cours passe en opacity 1

  $("main > section").each(function() {
    const top_position = $(this).position().top - $(window).scrollTop();
    if (top_position <= $(window).height() * 0.7) {
      $(this).css("opacity", 1);
      $(this).css("top", 0);
    }
  });
};

const showModal = e => {
  $("body").css("overflow-y", "hidden");
  $("body").append('<div class="modal" id="modal"></div>');
  $("#modal").click(function() {
    closeModal();
  });
  $("#modal").css({
    "background-color": "rgba(0,0,0,0)",
    transition: "background-color 0.6s"
  });

  setTimeout(() => {
    $("#modal").css("background-color", "rgba(0,0,0,0.9)");
  }, 1);

  // $("#modal h1").css({
  //   transform: "translateY(70vh)",
  //   transition: "transform 0.6s"
  // });

  setTimeout(() => {
    $("#modal h1").css("transform", "translateY(0)");
  }, 1);
};

const closeModal = () => {
  $("#modal").css("background-color", "rgba(0,0,0,0)");
  $("#modal").on("transitionend", () => {
    $("#modal").remove();
  });
  $("body").css("overflow-y", "auto");

  $("#modal h1").css("transform", "translateY(70vh)");
};
