<script>
    export default {
        name: 'search-bar',
        props:{
            filters:{
                type: Object,
                default: () => ({})
            }
        },
        data(){
            return {
                search: this.filters.serach || '',
                orderby: this.filters.orderby || ''
            }
        },
        methods: {
            submitSearchForm (){
                this.$refs.serachForm.submit()
            }
        }
    }
</script>