<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import moment from 'moment';
export default {
    name: "Main",
    components: {
        Mainlayout: MainLayout
    },
    props: {
        amoCrmHost: String,
        amoCrmToken: String,
        data: Object
    },
    data() {
        return {
            leads: []
        }
    },
    methods: {
        formatDate(date) {
            return moment(date).format('DD.MM.YYYY HH:mm');
        }
    },

    async mounted() {
        try {
            const response = await axios.get(this.route('get-leads'));
            console.log(response.data);
            // this.leads = response.data;
        } catch (error) {
            console.error('Ошибка при получении данных:', error);
        }
    }
}
</script>

<template>
    <h1>{{this.data}}</h1>
    <Mainlayout>
        <h1>Выбор сделки</h1>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата создания
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="lead in leads" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ lead.id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ lead.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ formatDate(lead.created_at) }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </Mainlayout>
</template>

<style scoped>

</style>
