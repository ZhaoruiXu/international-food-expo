jQuery.noConflict();
(($) => {
  const vendorsIso = {
    // Search Parameters
    searchTimeout: null,
    debounceTime: 500,
  
    // DOM References
    $grid: $(".vendors-grid"),
    $searchbar: $(".vendor-search"),
  
    init: () => {
      vendorsIso.$grid.isotope({
        itemSelector: '.vendor',
        layoutMode: 'fitRows'
      });

      // Search by vendors by text
      vendorsIso.$searchbar.on('input', (e) => {
        // Debounce
        clearTimeout(vendorsIso.searchTimeout);
        vendorsIso.searchTimeout = setTimeout(() => {
          // Use a regular expression to search for vendors
          qsRegex = new RegExp( e.target.value, 'gi' );
          vendorsIso.$grid.isotope({
            filter: function() {
              return qsRegex ? $(this).text().match( qsRegex ) : true;
            }
          });
        }, vendorsIso.debounceTime)
      })
    },
  }
  
  vendorsIso.init();
})(jQuery)



