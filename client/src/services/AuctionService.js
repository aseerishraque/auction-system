import Api from './ApiService';

export default {
    getAuction() {
        return Api().get('admin/auction');
    },

    storeAuction(auction) {
        return Api().post('/admin/auction', auction);
    },

    updateAuction(id, auction) {
        return Api().put('/admin/auction/' + id, auction);
    },
    getauctiondetails(id) {
        return Api().get('/auction/details/' + id);
    },
    getPastAuction() {
        return Api().get('auction/past');
    },
    updateAuctionStatus(id) {
        return Api().get('auction/past/' + id);
    },
    getRunningAuction() {
        return Api().get('auction/running');
    },
    getUpcomingAuction() {
        return Api().get('auction/upcoming');
    },
    
    
    
}