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

    deleteBidder(id){
        return Api().delete('admin/bidders/' + id);
    },

    getUserBids(id){
        return Api().get('bidder/bids/' + id);
    },

    bidProduct(data){
        return Api().post('bidder/bid', data);
    },

    deposit(data){
        return Api().post('bidder/deposit/', data);
    },

    getUserProducts(id){
        return Api().get('bidder/products/' + id);
    },

    getUserWinningProducts(id){
        return Api().get('bidder/winning-products/' + id);
    },


    declineProduct(data){
        return Api().post('bidder/decline-product', data);
    },

    payNow(data){
        return Api().post('bidder/pay-now', data);
    },
    
    getHomeItems(id){
        return Api().get('bidder/home-page-data/' + id);
    },

    approveBidder(id, is_approved){
        return Api().get('admin/approvebidder/' + id + '/status/' + is_approved);
    }
}