var TGCProposal = function() {
    function init() {
        initCoverLetterLinks();
    }
    
    function initCoverLetterLinks() {
        $(".show-full-letter").click(function(e) {
            e.preventDefault();
            
            var $parent = $(this).parent();
            $parent.hide();
            $parent.next().show();
        });
    }

    return {
        init: init
    }
}();

$(document).ready(TGCProposal.init);