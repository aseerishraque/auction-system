import Api from './ApiService';

export default {
    index() {
        return Api().get('admin/bidders');
    },

    store(bidder) {
        return Api().post('admin/bidders', bidder);
    },

    update(id, bidder) {
        return Api().put('admin/bidders/' + id, bidder);
    },

    getBidder(id){
        return Api().get('admin/bidders/' + id);
    },

    approveBidder(id, is_approved){
        return Api().get('admin/approvebidder/' + id + '/status/' + is_approved);
    }
}