(($) => {
  const aboutHistory = {
    // DOM References
    $buttons: $(".year-btn"),
    init: () => {
      
      aboutHistory.$buttons.click((e) => {
        e.preventDefault();

        let newYearClass = e.target.value;
        
        // Remove active class from the current year button and description
        $(".active").removeClass("active")

        // Add active class to new year
        $(`.${newYearClass}`).addClass("active");
      })
    },
  }
  
  aboutHistory.init();
})(jQuery)