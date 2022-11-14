import axios from "axios";

function postData(data) {
    return axios.post(`/lead.add`, data)
        .then(response => {
            return response
        })
}

export default {
    postData
};
