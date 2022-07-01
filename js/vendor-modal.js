jQuery.noConflict();
(($)=>{
  const vendorModal = {
    vendorData: null,
    dataLoaded: false,
    currentVendor: null,
    modalIsOpen: false,

    // DOM References
    $modal: $(".vendor-modal"),
    $heading: $(".vendor-modal-heading"),
    $text: $(".vendor-modal-text"),
    $img: $(".vendor-modal-image"),
    $closeBtn: $(".vendor-modal-close-btn"),
    $vendorLinks: $(".vendor-link"),

    openModal: () => {
      vendorModal.$modal.removeClass("hidden")
      vendorModal.modalIsOpen = true;
    },

    closeModal: () => {
      vendorModal.$modal.addClass("hidden")
      vendorModal.modalIsOpen = false;
    },

    toggleModal: () => {
      vendorModal.$modal.toggleClass("hidden")
      vendorModal.modalIsOpen = !vendorModal.modalIsOpen;
    },

    init: () => {
      const vendorPath = `https://foodexpo.bcitwebdeveloper.ca/wp-json/wp/v2/ife-vendor?_embed`

      const fetchData = async () => {
        const response = await fetch(vendorPath)
        if ( response.ok ) {
          vendorModal.vendorData = await response.json();
          vendorModal.dataLoaded = true;
        }
      }
      fetchData()
      
      // On vendor click, open the vendor modal
      vendorModal.$vendorLinks.click((e) => {
        e.preventDefault();
        
        // Get vendor id stored in modal's id prop
        const vendorId = e.currentTarget.id;
        
        if (vendorModal.dataLoaded && !vendorModal.modalIsOpen) {
          e.stopPropagation();

          // Find the correct vendor data
          vendorModal.currentVendor = vendorModal.vendorData.find(vendor => vendor.id == vendorId)
          
          // Update the modal
          // Heading
          vendorModal.$heading.text(vendorModal.currentVendor.title.rendered);

          // Body Text
          vendorModal.$text.text(vendorModal.currentVendor.acf.company_description);

          // Img
          const updateModal = async () => {
            let imageDetails = vendorModal.currentVendor["_embedded"]["wp:featuredmedia"][0];
            let imgSrc = imageDetails.source_url;
            if (imageDetails.media_details.width > 500 || imageDetails.media_details.height > 500) {
              imgSrc = imageDetails.media_details.sizes['ife-vendor-logo'].source_url;  
            }
            await vendorModal.$img.attr('src',imgSrc)
            vendorModal.$img.attr('alt',`${vendorModal.currentVendor.title.rendered} logo`)
            vendorModal.openModal();
          }
          updateModal()

          
          
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