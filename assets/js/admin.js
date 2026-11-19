jQuery( document ).ready( function( $ ){
    // Logo header ---------------------
    let FashLogoHeader;
    $('#fashLogoHeader').on('click', function( e ){
        e.preventDefault();
        if( FashLogoHeader ){
            FashLogoHeader.open();
            return;
        }

        FashLogoHeader = wp.media({
            title: 'Ganti logo header',
            button: {
                text: 'Gunakan Gambar'
            },
            multiple: false
        });

        FashLogoHeader.on('select', function(){
            const attachment = FashLogoHeader.state().get('selection').first().toJSON();
            $('#fashLogoHeader_id').val( attachment.url );
        });

        FashLogoHeader.open();
    });


    // Logo Footer ---------------------
    let FashLogoFooter;
    $('#fashLogoFooter').on('click', function( e ){
        e.preventDefault();
        if( FashLogoFooter ){
            FashLogoFooter.open();
            return;
        }

        FashLogoFooter = wp.media({
            title: 'Ganti logo footer',
            button: {
                text: 'Gunakan Gambar'
            },
            multiple: false
        });

        FashLogoFooter.on('select', function(){
            const attachment = FashLogoFooter.state().get('selection').first().toJSON();
            $('#fashLogoFooter_id').val( attachment.url );
        });

        FashLogoFooter.open();
    });
});