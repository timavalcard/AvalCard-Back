import grapesjs from "grapesjs";
import fa from "grapesjs/src/i18n/locale/fa";



var lp = './img/';
var plp = 'https://via.placeholder.com/350x250/';
var images = [
    lp+'team1.jpg', lp+'team2.jpg', lp+'team3.jpg', plp+'78c5d6/fff/image1.jpg', plp+'459ba8/fff/image2.jpg', plp+'79c267/fff/image3.jpg',
    plp+'c5d647/fff/image4.jpg', plp+'f28c33/fff/image5.jpg', plp+'e868a2/fff/image6.jpg', plp+'cc4360/fff/image7.jpg',
    lp+'work-desk.jpg', lp+'phone-app.png', lp+'bg-gr-v.png'
];
var editor  = grapesjs.init({
    container : '#gjs',
    fromElement: 1,
    clearOnRender: true,
    plugins: [
        'gjs-blocks-basic',
        'grapesjs-component-countdown',
        'grapesjs-plugin-export',
        'grapesjs-tabs',
        'grapesjs-custom-code',
        'grapesjs-touch',
        'grapesjs-parser-postcss',
        'grapesjs-tooltip',
        'grapesjs-tui-image-editor',
        'grapesjs-typed',
        'grapesjs-style-bg',
        'grapesjs-preset-webpage',
    ],
    i18n: {
       locale: fa, // default locale
        //detectLocale: true, // by default, the editor will detect the language
        localeFallback: fa, // default fallback
        messages: { fa },
    }
})
editor.Panels.addButton
('options',
    [
        {
        id: 'save-db',
        className: 'fa fa-floppy-o',
        command: 'save-db',
        attributes: {title: 'ذخیره'}
    }
    ]
);
const blockManager = editor.Blocks;





blockManager.add('h1-block', {
    label: 'h1',
    media:"<svg viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M18.5,4L19.66,8.35L18.7,8.61C18.25,7.74 17.79,6.87 17.26,6.43C16.73,6 16.11,6 15.5,6H13V16.5C13,17 13,17.5 13.33,17.75C13.67,18 14.33,18 15,18V19H9V18C9.67,18 10.33,18 10.67,17.75C11,17.5 11,17 11,16.5V6H8.5C7.89,6 7.27,6 6.74,6.43C6.21,6.87 5.75,7.74 5.3,8.61L4.34,8.35L5.5,4H18.5Z\"></path></svg>",
    content: '<h1>Put your title here</h1>',
    category: 'Basic',
    attributes: {
        title: 'Insert h1 block'
    }
});
blockManager.add('h2-block', {
    label: 'h2',
    media:"<svg viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M18.5,4L19.66,8.35L18.7,8.61C18.25,7.74 17.79,6.87 17.26,6.43C16.73,6 16.11,6 15.5,6H13V16.5C13,17 13,17.5 13.33,17.75C13.67,18 14.33,18 15,18V19H9V18C9.67,18 10.33,18 10.67,17.75C11,17.5 11,17 11,16.5V6H8.5C7.89,6 7.27,6 6.74,6.43C6.21,6.87 5.75,7.74 5.3,8.61L4.34,8.35L5.5,4H18.5Z\"></path></svg>",
    content: '<h2>Put your title here</h2>',
    category: 'Basic',
    attributes: {
        title: 'Insert h2 block'
    }
});
blockManager.add('h3-block', {
    label: 'h3',
    media:"<svg viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M18.5,4L19.66,8.35L18.7,8.61C18.25,7.74 17.79,6.87 17.26,6.43C16.73,6 16.11,6 15.5,6H13V16.5C13,17 13,17.5 13.33,17.75C13.67,18 14.33,18 15,18V19H9V18C9.67,18 10.33,18 10.67,17.75C11,17.5 11,17 11,16.5V6H8.5C7.89,6 7.27,6 6.74,6.43C6.21,6.87 5.75,7.74 5.3,8.61L4.34,8.35L5.5,4H18.5Z\"></path></svg>",
    content: '<h3>Put your title here</h3>',
    category: 'Basic',
    attributes: {
        title: 'Insert h3 block'
    }
});
blockManager.add('h4-block', {
    label: 'h4',
    media:"<svg viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M18.5,4L19.66,8.35L18.7,8.61C18.25,7.74 17.79,6.87 17.26,6.43C16.73,6 16.11,6 15.5,6H13V16.5C13,17 13,17.5 13.33,17.75C13.67,18 14.33,18 15,18V19H9V18C9.67,18 10.33,18 10.67,17.75C11,17.5 11,17 11,16.5V6H8.5C7.89,6 7.27,6 6.74,6.43C6.21,6.87 5.75,7.74 5.3,8.61L4.34,8.35L5.5,4H18.5Z\"></path></svg>",
    content: '<h4>Put your title here</h4>',
    category: 'Basic',
    attributes: {
        title: 'Insert h4 block'
    }
});



// Add the command
editor.Commands.add
('save-db',
    {
        run: function(editor, sender)
        {
            sender && sender.set('active', 0); // turn off the button
            editor.store();

            var htmldata = editor.getComponents();
            var cssdata = editor.getCss();
            console.log(htmldata);
            console.log(cssdata);
            $.post("templates/template",
                {
                    html: htmldata,
                    css: cssdata
                });
        }
    });
