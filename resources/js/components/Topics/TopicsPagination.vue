<template>
    <div class="pull-right">
        <pagination
            v-model="page" 
            :options="options"
            :records="pagination.total"
            :page="pagination.current_page"
            :per-page="pagination.per_page"
            @paginate="paginate"
        />
    </div>
</template>

<script>
import Pagination from 'vue-pagination-2'
export default {
    name: 'TopicsPagination',
    components: { Pagination },
    props: {
        pagination: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            page: 1,
            options: {
                theme: 'bootstrap4',
                texts: {
                    count: 'Mostrando {from} a {to} de {count} registros|{count} registro|Un registro',
                    first: 'Primero',
                    last: 'Último',
                }
            }
        }
    },
    methods: {
        paginate(page) {
            this.$learningBus.$emit('topics:pagination:fired', page);
        }
    },
}
</script>