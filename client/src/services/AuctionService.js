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
    deleteAuction(id) {
        return Api().delete('/admin/auction/' + id);
    },
    getauctiondetails(id) {
        return Api().get('auction-data/details/' + id); //public route
    },
    getPastAuction() {
        return Api().get('admin/auction-data/past');
    },
    updateAuctionStatus(id) {
        return Api().get('admin/auction-data/past/' + id);
    },
    getRunningAuction() {
        return Api().get('auction-data/running'); //public route
    },
    getUpcomingAuction() {
        return Api().get('auction-data/upcoming');
    },
    
    
    
}