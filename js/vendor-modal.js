jQuery.noConflict();
(($)=>{
  const vendorModal = {
    vendorData: null,
    dataLoaded: false,
    currentVendor: null,

    // DOM References
    $modal: $(".vendor-modal"),
    $heading: $(".vendor-modal-heading"),
    $text: $(".vendor-modal-text"),
    $img: $(".vendor-modal-image"),
    $closeBtn: $(".vendor-modal-close-btn"),
    $vendorLinks: $(".vendor-link"),

    openModal: () => {
      vendorModal.$modal.removeClass("hidden")
    },

    closeModal: () => {
      vendorModal.$modal.addClass("hidden")
    },

    toggleModal: () => {
      vendorModal.$modal.toggleClass("hidden")
    },

    init: () => {
      const vendorPath = `https://foodexpo.bcitwebdeveloper.ca/wp-json/wp/v2/ife-vendor`

      const fetchData = async () => {
        const response = await fetch(vendorPath)
        if ( response.ok ) {
          vendorModal.vendorData = await response.json();
          console.log(vendorModal.vendorData);
          vendorModal.dataLoaded = true;
        }
      }
      fetchData()
      
      // On vendor click, open the vendor modal
      vendorModal.$vendorLinks.click((e) => {
        e.preventDefault();
        
        const vendorId = e.currentTarget.id;

        if (vendorModal.dataLoaded) {
          vendorModal.currentVendor = vendorModal.vendorData.find(vendor => vendor.id == vendorId)
          
          vendorModal.$heading.text(vendorModal.currentVendor.title.rendered);
          vendorModal.$text.text(vendorModal.currentVendor.acf.company_description);
  
          vendorModal.openModal();
        }
      })

      vendorModal.$closeBtn.click((e) => {
        e.preventDefault();

        vendorModal.closeModal();
      })
    },
  }

  vendorModal.init();

})(jQuery)