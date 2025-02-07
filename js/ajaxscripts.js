jQuery(document).ready(function($) {
    var $searchInput = $('#search-input');
    var $submitButton = $('.input-btn-places');

    $searchInput.autocomplete({
        source: function(request, response) {
            $.ajax({
                url: ajax_object.ajax_url,
                dataType: 'json',
                data: {
                    action: 'auto_suggest',
                    term: request.term,
                },
                success: function(data) {
                    if (data.length === 0) {
                        data.push({ label: 'Result not found', value: 'result_not_found' });
                    }
                    response(data);
                }
            });
        },
        minLength:1, // Minimum characters before triggering auto-suggest
        select: function(event, ui) {
            // Disable the submit button when "Result not found" is selected
            if (ui.item && ui.item.value === 'result_not_found') {
                $submitButton.attr('disabled', 'disabled');
            } else {
                $submitButton.removeAttr('disabled');
            }
        }
    }).autocomplete('instance')._renderItem = function(ul, item) {
        // Custom rendering of each suggestion item
        var listItem = $('<li>');
        if (item.value === 'result_not_found') {
            listItem.addClass('result-not-found');
        }
        listItem.append('<div>' + item.label + '</div>').appendTo(ul);
        return listItem;
    };

    $searchInput.on('input', function() {
        // Disable the submit button if the input text is empty
        if ($(this).val().trim() === '') {
            $submitButton.attr('disabled', 'disabled');
        }
    });

      document.getElementById("triggger").addEventListener("click", () => {
        Fancybox.show([
          {
            src: "private-message/?recipient_id=45",
            width: 800,
            height: 600,
          },
        ]);
      });  
});
