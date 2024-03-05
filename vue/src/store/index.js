import {createStore} from "vuex";
import userActions from "@/store/modules/userActions";
import postActions from "@/store/modules/postActions.js";

export default createStore({
    modules: {
        userActions,
        postActions
    },

});
