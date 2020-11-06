import Litepicker from 'litepicker'

export default class DateLitePicker extends HTMLInputElement {
    constructor() {
        super()

        this.picker = new Litepicker({
            element: this,
            inlineMode: this.getAttribute('inline') === 'true',
        })

        this.setBounds = this.setBounds.bind(this)
    }

    setBounds() {
        const excluded = ['constructor', 'init']
        let proto = Litepicker.prototype

        for (const attr in proto) {
            if (proto.hasOwnProperty(attr) && !excluded.includes(attr)) {
                if (typeof proto[attr] === 'function') {
                    this[attr] = (...args) => {
                        return this.picker[attr].apply(this.picker, args)
                    }
                }
            }
        }
    }

    connectedCallback() {
        this.setBounds()

        this.picker.setOptions({
            singleDate: true,
            format: 'YYYY-MM-DD\\T00:00:00',
        })
    }
}