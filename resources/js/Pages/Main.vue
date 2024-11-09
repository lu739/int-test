<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import moment from 'moment';
import { route } from 'ziggy-js';
export default {
    name: "Main",
    components: {
        Mainlayout: MainLayout
    },
    data() {
        return {
            leads: []
        }
    },
    methods: {
        formatDate(date) {
            return moment.unix(date).format('DD.MM.YYYY HH:mm');
        },

        fetchLeads() {
            axios.get(route('get-leads'))
                .then(response => {
                    this.leads = response.data?.data?._embedded?.leads ?? [];
                })
                .catch(error => {
                    console.error(error);
                });
        },

        bindContact(id) {
            this.$inertia.get(route('bind-contact', { lead_id: id }));
        }
    },
    mounted() {
        this.fetchLeads();
    }
}
</script>

<template>
    <Mainlayout>
        <h1 class="font-bold mb-2 text-2xl">Выбор сделки</h1>

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
                        <th scope="col" class="px-6 py-3">
                            Есть контакт
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Привязать контакт
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="lead in leads" :key="lead.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ lead.id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ lead.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ formatDate(lead.created_at) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ lead._embedded?.contacts?.length ? 'Да' : 'Нет' }}
                    </td>
                    <td class="px-6 py-4">
                        <button v-if="lead._embedded?.contacts?.length === 0"
                           @click="this.bindContact(lead.id)"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Привязать</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </Mainlayout>
</template>

<style scoped>

</style>
