<template>
    <div class="btn-group">
        <button 
            @click="activePage1-1 >= 1 ? setActivePage(activePage1-1) : null"
            class="btn">
            Previous
        </button> 
        <!-- <button @click="setActivePage" class="btn">1</button>  -->
        <!-- <button class="btn btn-active">2</button>  -->

        <button @click="setActivePage(page)" v-for="page in pages" :key="page" :class="activePage1===page ? 'btn btn-active' : 'btn'">{{ page }}</button> 
        <button 
            @click="activePage1 <= totalPages-1 ? setActivePage(activePage1+1) : null"
            class="btn">
            Next
        </button>
    </div>
</template>
<script>
// const {total, pageCount, activePage, setActivePage} = this.props;
// const pages = _.range(1, totalPages+1, 1);
import _ from 'lodash';
export default {
    name:'Pagination',
    props:[
        'total', 'pageCount', 'activePage'
    ],
    data() {
        return {
            totalPages: '',
            pages: '',
            activePage1: this.activePage,
        }
    },
    created() {
        this.totalPages = Math.ceil(this.total/this.pageCount);
        this.pages = _.range(1, this.totalPages+1, 1);
        // console.log(this.total);
    },
    methods: {
        setActivePage(page){
            this.$emit('setActivePage', {page});
            this.activePage1 = page;
        }
    },
}
</script>