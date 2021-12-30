import {extend} from "vee-validate";
import {required, email, numeric, min, max, confirmed} from "vee-validate/dist/rules";

extend("min", min);
extend("max", max);
extend("confirmed", confirmed);

extend("numeric", {
  ...numeric,
  message: "*Petq a lini tiv mutqagrvac"
});


extend("required", {
  ...required,
  message: "*Заполнение необходимо"
});

extend("password", {
  message: "*Используйте 8+ символов, состоящих из букв, цифр и символов.",
  validate(value) {
    let reg = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\\$%\\^&\\*])(?=.{7,})');
    return reg.test(value)
  }
});

extend("email", {
  ...email,
  message: "*Введите правильный адрес электронной почты"
});

extend("email", {
  ...email,
  message: "*Введите правильный адрес электронной почты"
});


extend("username", {
  message: '*Разрешены только буквы и цифры',
  validate(value) {
    let reg = new RegExp('^[a-zA-Z0-9]*$');
    return reg.test(value)
  }
})

