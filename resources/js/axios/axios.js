import axios from "axios";
import router from "../router/index";
import store from "../store/index.js"
import { baseMessage } from '../helpers/FlashMessage';

const instance = axios.create({
    baseURL: "http://localhost/",
});

instance.defaults.headers.get["Accepts"] = "application/json";

instance.interceptors.request.use(
    config => {
        const idToken = store.getters['auth/getAuthToken'];

        if(idToken) {
            config.headers.authorization = `Bearer ${idToken}`;
        }

        return config;
    },
    error => Promise.reject(error)
);


instance.interceptors.response.use(
    (response) => response,
    (error) => {

        if (error.response.status === 500 || error.response.status === 404) {

            window.VueGlobal.flashMessage.error(baseMessage({
                title: "Felmeddelade",
                message: "Något gick fel. Vänligen prova igen"
            }));

            return error;
        }

        if(error.response.status === 400) {
            const error_messanges = error.response.data.error_message;
            let errors = [];

            if(typeof error_messanges !== "object") {
                errors['errors'] = error_messanges;
            } else {
                errors = error_messanges;
            }

            Object.keys(errors).forEach(key => {
                window.VueGlobal.flashMessage.error(baseMessage( {
                    message: errors[key][0]
                }));
            });

            return error;
        }


        if (error.response.status === 401) {
            window.VueGlobal.flashMessage.error(baseMessage({
                title: "Åtkomst nekad",
            }));

            router.replace("/");
        }

        return Promise.reject(error);
    }
);

export default instance;
