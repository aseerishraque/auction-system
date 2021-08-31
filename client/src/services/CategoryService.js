import Api from './ApiService';

export default {
    index() {
        return Api().get('categories');
    },

    store(category) {
        return Api().post('admin/categories', category);
    },

    update(id, category) {
        return Api().put('admin/categories/' + id, category);
    }
}