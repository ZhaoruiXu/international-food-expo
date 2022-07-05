jQuery.noConflict();
(($)=>{
  const vendorModal = {
    vendorData: null,
    dataLoaded: false,
    currentVendor: null,
    modalIsOpen: false,

    // DOM References
    $modal: $(".vendor-modal"),
    $wrapper: $(".vendor-modal-wrapper"),
    $heading: $(".vendor-modal-heading"),
    $text: $(".vendor-modal-text"),
    $img: $(".vendor-modal-image"),
    $closeBtn: $(".vendor-modal-close-btn"),
    $vendorLinks: $(".vendor-link"),
    $body: $("body"),

    openModal: () => {
      vendorModal.$modal.removeClass("hidden")
      vendorModal.$body.addClass("stop-scroll")
      vendorModal.modalIsOpen = true;
    },
    
    closeModal: () => {
      vendorModal.$modal.addClass("hidden")
      vendorModal.$body.removeClass("stop-scroll")
      vendorModal.modalIsOpen = false;
    },

    toggleModal: () => {
      vendorModal.$modal.toggleClass("hidden")
      vendorModal.$body.toggleClass("stop-scroll")
      vendorModal.modalIsOpen = !vendorModal.modalIsOpen;
    },

    init: () => {
      
      // On vendor click, open the vendor modal
      vendorModal.$vendorLinks.click((e) => {
        e.preventDefault();
        // e.stopPropagation();
        
        if (!vendorModal.modalIsOpen) {
          // Get vendor id stored in modal's id prop
          const vendorId = e.currentTarget.id;

          const vendorPath = `https://foodexpo.bcitwebdeveloper.ca/wp-json/wp/v2/ife-vendor/${vendorId}?_embed`
    
          const fetchData = async () => {
            const response = await fetch(vendorPath)
            if ( response.ok ) {
              const currentVendor = await response.json();

              // Update the modal
              // Heading
              vendorModal.$heading.html(currentVendor.title.rendered);
    
              // Body Text
              vendorModal.$text.html(currentVendor.acf.company_description);
    
              // Img
              const updateModal = async () => {
                let imageDetails = currentVendor["_embedded"]["wp:featuredmedia"][0];
                let imgSrc = imageDetails.source_url;
                if (imageDetails.media_details.width > 500 || imageDetails.media_details.height > 500) {
                  imgSrc = imageDetails.media_details.sizes['ife-vendor-logo'].source_url;  
                }
                await vendorModal.$img.attr('src',imgSrc)
                vendorModal.$img.attr('alt',`${currentVendor.title.rendered} logo`)
                vendorModal.openModal();
              }
              updateModal()
            }
          }
          fetchData()
        }
      })

      // Close modal when clicking the close button
      vendorModal.$closeBtn.click((e) => {
        e.preventDefault();
        e.stopPropagation();

        vendorModal.closeModal();
      })

      $("body").click((e) => {
        // Close the modal if clicking outside the modal
        if( 
          vendorModal.modalIsOpen && 
          !jQuery.contains(vendorModal.$modal[0], e.target) && 
          vendorModal.$modal[0] !== e.target 
        ) {
          vendorModal.closeModal();
        }
      })
    },
  }

  vendorModal.init();

})(jQuery)