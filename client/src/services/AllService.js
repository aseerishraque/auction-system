import Api from './ApiService';

export default {
    getallAuction() {
        return Api().get('auction/all');
    },
    getallCount() {
        return Api().get('count/all');
    }
}