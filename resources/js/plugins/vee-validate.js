import { extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import { messages } from 'vee-validate/dist/locale/es.json';

Object.keys(rules).forEach(rule => {
    extend(rule, {
        ...rules[rule], // rule
        message: messages[rule], // override messages
    });
});

extend('wysiwyg-required', {
    ...rules['required'],
    message: 'El campo descripción es requerido',
});

extend('wysiwyg-min', {
    ...rules['min'],
    message: 'El campo descripción ha de tener al menos {length} caracteres',
});
