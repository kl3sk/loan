/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css'

import 'bootstrap/scss/bootstrap.scss'

import 'bootstrap'
import 'popper.js'
import '@fortawesome/fontawesome-free/js/all.min'

import 'lightgallery.js'
import 'lg-thumbnail.js'
import 'lg-zoom.js'
import 'lg-rotate.js'
import 'lightgallery.js/src/css/lightgallery.css'
import '@js/components/components'

const galleries = document.querySelectorAll('.lbox .images')

Array.from(galleries).forEach(gallery => {
    if (gallery) {
        // https://sachinchoolur.github.io/lightgallery.js/demos/dynamic.html
        gallery.addEventListener('click', e => {
            e.preventDefault()
            const target = gallery
            lightGallery(target, {
                dynamic: true,
                thumbnail: true,
                // download: false,
                dynamicEl: JSON.parse(target.dataset.images),
            })
        })
    }
})

