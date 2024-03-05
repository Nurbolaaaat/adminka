import {toast} from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export const notify = (toastState, toastText) => {
    if (toastState) {
        toast.success(toastText, {
            autoClose: 7000,
        });
    } else {
        toast.error(toastText, {
            autoClose: 7000,
        });
    }
};