<script>
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    name: "Main",
    components: {
        Mainlayout: MainLayout
    },
    props: {
        amoCrmHost: String,
        amoCrmToken: String
    },
    data() {
        return {
            leads: []
        }
    },
    mounted() {
        const token =
            // localStorage.getItem('AMO_CRM_TOKEN') ||
            this.amoCrmToken;
        axios.get(`${this.amoCrmHost}api/v4/leads`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(response => {
            this.leads = response.data?._embedded?.leads ?? [];
        }).catch(error => {
            console.error(error);
        });
    }
}
</script>

<template>
    <Mainlayout>
        <h1>Выбор сделки</h1>

        <table class="table-auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="lead in leads">
                <td>{{ lead.id }}</td>
                <td>{{ lead.name }}</td>
                <td>{{ lead.created_at }}</td>
            </tr>
            </tbody>
        </table>
    </Mainlayout>
</template>

<style scoped>

</style>
