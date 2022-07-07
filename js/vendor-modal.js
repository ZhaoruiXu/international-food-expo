jQuery.noConflict();
(($)=>{
  const vendorModal = {
    vendorData: null,
    dataLoaded: false,
    currentVendor: null,
    modalIsOpen: false,

    // DOM References
    $modalBackground: $(".vendor-modal"),
    $modalWrapper: $(".vendor-modal .vendor-modal-wrapper"),
    $content: $(".vendor-modal .vendor-modal-content"),
    $heading: $(".vendor-modal .vendor-modal-heading"),
    $text: $(".vendor-modal .vendor-modal-text"),
    $img: $(".vendor-modal .vendor-modal-image"),
    $closeBtn: $(".vendor-modal .vendor-modal-close-btn"),
    $vendorLinks: $(".vendor-link"),
    $body: $("body"),
    $loading: $(".vendor-modal .loading-icon"),

    openModal: () => {
      vendorModal.$modalBackground.removeClass("hidden")
      vendorModal.$body.addClass("stop-scroll")
      vendorModal.modalIsOpen = true;
    },
    
    closeModal: () => {
      vendorModal.$modalBackground.addClass("hidden")
      vendorModal.$content.addClass("hidden")
      vendorModal.$body.removeClass("stop-scroll")
      vendorModal.modalIsOpen = false;
    },

    toggleModal: () => {
      vendorModal.$modalBackground.toggleClass("hidden")
      vendorModal.$body.toggleClass("stop-scroll")
      vendorModal.modalIsOpen = !vendorModal.modalIsOpen;
    },

    init: () => {
      
      // On vendor click, open the vendor modal
      vendorModal.$vendorLinks.click((e) => {
        e.preventDefault();
        
        if (!vendorModal.modalIsOpen) {
          // Open modal with loading icon showing and content hidden
          vendorModal.$loading.removeClass("hidden")
          vendorModal.$content.addClass("hidden")
          
          // Reset vendor details
          vendorModal.$heading.html("")
          vendorModal.$text.html("")
          vendorModal.$img.attr('src', "")
          vendorModal.$img.attr('alt', "")
          
          vendorModal.openModal();

          // Get vendor id stored in modal's id prop
          const vendorId = e.currentTarget.id;

          const vendorPath = `https://foodexpo.bcitwebdeveloper.ca/wp-json/wp/v2/ife-vendor/${vendorId}?_embed`
    
          const fetchData = async () => {
            const response = await fetch(vendorPath)
            if ( response.ok ) {
              const currentVendor = await response.json();
              
              let imageDetails = currentVendor["_embedded"]["wp:featuredmedia"][0];
              let imgSrc = imageDetails.source_url;
              if (imageDetails.media_details.width > 500 || imageDetails.media_details.height > 500) {
                imgSrc = imageDetails.media_details.sizes['ife-vendor-logo'].source_url;  
              }
              vendorModal.$img.attr('src',imgSrc)
              vendorModal.$img.attr('alt',`${currentVendor.title.rendered} logo`)

              vendorModal.$heading.html(`${currentVendor.title.rendered}`)
              vendorModal.$text.html(`${currentVendor.acf.company_description}`)
              vendorModal.$heading.attr('src', imgSrc)
              vendorModal.$heading.attr('alt', `${currentVendor.title.rendered} logo`)

              // Hide loading and show content
              vendorModal.$loading.addClass("hidden")
              vendorModal.$content.removeClass("hidden")
          
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

      vendorModal.$modalBackground.click((e) => {
        e.stopPropagation();
        if( vendorModal.modalIsOpen && e.target === vendorModal.$modalBackground[0] ) {
          vendorModal.closeModal();
        }
      })
    },
  }

  vendorModal.init();

})(jQuery)