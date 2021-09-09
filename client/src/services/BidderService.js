import Api from './ApiService';

export default {
    index() {
        return Api().get('admin/bidders');
    },

    store(bidder) {
        return Api().post('admin/bidders', bidder);
    },

    update(id, bidder) {
        return Api().put('bidders/' + id, bidder);
    },

    getBidder(id){
        return Api().get('bidders/' + id);
    },
    getUserBids(id){
        return Api().get('bidder/bids/' + id);
    },
    getUserProducts(id){
        return Api().get('bidder/products/' + id);
    },

    approveBidder(id, is_approved){
        return Api().get('admin/approvebidder/' + id + '/status/' + is_approved);
    }
}