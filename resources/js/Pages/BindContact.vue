<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import TextInput from "@/Components/TextInput.vue";
import { route } from 'ziggy-js';
export default {
    name: "BindContact",
    components: {
        TextInput,
        Mainlayout: MainLayout
    },
    props: {
        leadId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            contact: {
                name: '',
                phone: '',
                comment: ''
            },
            validationError: false,
            successBinding: false,
            hasContact: false
        }
    },
    methods: {
        getContacts(leadId) {
            axios.get(route('get-contacts', { lead_id: leadId }))
                .then(response => {
                    this.hasContact = response.data?.data?._embedded?.links?.length > 0;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        bindContact() {
            if (this.hasContact) {
                return;
            }
            if (this.contact.name === '' || this.contact.phone === '' || this.contact.comment === '') {
                this.validationError = true;
                return;
            }
            this.validationError = false;

            axios.post(route('bind-contact-to-lead'), {
                'contact': this.contact,
                'lead_id': this.leadId
            })
                .then(response => {
                    if (response.status === 200) {
                        this.contact = {
                            name: '',
                            phone: '',
                            comment: ''
                        };
                        this.successBinding = true;
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },

    mounted() {
        this.getContacts(this.leadId);
    },
}
</script>

<template>
    <Mainlayout>
        <h1 class="font-bold mb-2 text-2xl">Привязка контакта</h1>

        <p v-if="validationError" class="text-red-500 mb-1">Заполните все поля</p>

        <p v-if="successBinding" class="text-green-500 mb-1">Контакт привязан к сделке</p>

        <p v-if="hasContact" class="text-red-500 mb-1">Контакт уже привязан к этой сделке</p>

        <form v-if="!this.hasContact && !this.successBinding" class="w-full max-w-lg">
            <TextInput class="w-full mb-2" v-model=this.contact.name placeholder="Имя контакта" />
            <TextInput class="w-full mb-2" v-model=this.contact.phone placeholder="Номер телефона контакта" />
            <TextInput class="w-full mb-2" v-model=this.contact.comment placeholder="Комментарий" />

            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded"
                    @click.prevent="bindContact">Привязать</button>
        </form>
    </Mainlayout>
</template>

<style scoped>

</style>
