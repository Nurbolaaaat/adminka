import axios from "@/utils/axios.js";
import router from "@/router/index.js";

const actions = {
    async getAllPostData({commit}) {
        try {
            const {data} = await axios.get("/posts");
            commit("updateAllPosts", data);
        } catch (error) {
            commit("updateAllPosts", error.response);
            console.error(error);
        }
    },
    async updatePost({commit}, {id, form}) {
        console.log( form)
        console.log(commit)
        await axios.put("/posts/" + id, form);
    },
    async createPost({commit},form) {
        try {
            const {data} = await axios.post("/posts", form);
            commit ("updateNewPost", data);
        } catch (error) {
            console.error(error);
            commit ("updateNewPost", error.response);
        }
    },
    async detailPost({commit},id) {
        try {
            const {data} = await axios.get(`/posts/${id}`, {
                params:router.currentRoute.value.query
            });
            commit("updateGetDetailPost", data);
        } catch (error) {
            console.error(error);
            commit("updateGetDetailPost", error.response);
        }
    }
};
const mutations = {
    updateAllPosts: (state, res) => {
        state.postsState = res;
    },
    updateNewPost: (state, res) => {
        state.createState = res;
    },
    updateGetDetailPost: (state, res) => {
        state.getDetailState = res;
    }
};
const state = {
    postsState: null,
    createState: null,
    getDetailState: null

};
const getters = {
    getAllPosts: (state) => state.postsState,
    getNewPost: (state) => state.createState,
    getDetailPost: (state) => state.getDetailState
};

export default {state, getters, mutations, actions};
