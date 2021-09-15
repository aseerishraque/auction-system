import Api from './ApiService';

export default {
    getProduct() {
        return Api().get('admin/products');
    },

    storeProduct(product) {
        return Api().post('/admin/products', product);
    },

    updateProduct(id, product) {
        return Api().put('/admin/products/' + id, product);
    },

    getcurrentproducts(id) {
        return Api().get('auction/create/getproduct/' + id);
    },

    deleteProduct(id) {
        return Api().delete('admin/products/' + id);
    },
    
}