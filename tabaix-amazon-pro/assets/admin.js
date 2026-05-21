jQuery(document).ready(function($) {
    $('#tabaix-amz-search-btn').on('click', function() {
        const query = $('#tabaix-amz-search-input').val();
        if (!query) return;

        const resultsContainer = $('#tabaix-amz-results');
        resultsContainer.html('<p>Searching live on Amazon via Vercel...</p>');

        $.ajax({
            url: tabaixAmzData.apiUrl + '/api/search',
            data: { q: query },
            method: 'GET',
            success: function(response) {
                if (response.success && response.data.length > 0) {
                    let html = '<ul style="list-style:none; padding:0; margin:0;">';
                    response.data.forEach(item => {
                        // Create a safe shortcode
                        const shortcode = `[tabaix_amazon asin="${item.asin}" title="${item.title.replace(/"/g, "'")}" price="${item.price}" image="${item.image}" rating="${item.rating}"]`;
                        
                        html += `
                            <li style="border-bottom:1px solid #ddd; padding:10px 0; display:flex; gap:10px; align-items:center;">
                                <img src="${item.image}" style="width:40px; height:40px; object-fit:contain;" />
                                <div style="flex-grow:1;">
                                    <div style="font-size:12px; font-weight:bold; line-height:1.2; margin-bottom:5px;">${item.title.substring(0, 50)}...</div>
                                    <div style="color:#b12704; font-weight:bold; font-size:11px;">${item.price || 'Check Price'}</div>
                                </div>
                                <button type="button" class="button tabaix-insert-btn" data-shortcode='${shortcode}'>Insert</button>
                            </li>
                        `;
                    });
                    html += '</ul>';
                    resultsContainer.html(html);
                } else {
                    resultsContainer.html('<p>No products found.</p>');
                }
            },
            error: function() {
                resultsContainer.html('<p style="color:red;">Error connecting to Vercel API.</p>');
            }
        });
    });

    // Insert shortcode into WordPress editor
    $(document).on('click', '.tabaix-insert-btn', function() {
        const shortcode = $(this).attr('data-shortcode');
        if (wp.data && wp.data.dispatch('core/block-editor')) {
            // Gutenberg
            const block = wp.blocks.createBlock('core/shortcode', { text: shortcode });
            wp.data.dispatch('core/block-editor').insertBlocks(block);
        } else if (typeof tinymce !== 'undefined' && tinymce.activeEditor && !tinymce.activeEditor.isHidden()) {
            // Classic Editor (Visual)
            tinymce.activeEditor.execCommand('mceInsertContent', false, shortcode);
        } else {
            // Classic Editor (Text)
            const cursor = document.getElementById('content').selectionStart;
            const content = $('#content').val();
            $('#content').val(content.substring(0, cursor) + shortcode + content.substring(cursor));
        }
    });
});
