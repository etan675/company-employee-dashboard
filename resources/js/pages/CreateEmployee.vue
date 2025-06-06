<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Company } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps<{
    company: {
        data: Company
    }
}>();
const company = props.company.data;

const form = useForm({
    firstName: '',
    lastName: '',
    email: '',
    address: '',
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: company.name,
        href: '/companies/' + company.id,
    },
    {
        title: 'Create Employee',
        href: 'companies/' + company.id + '/employees/new',
    }
];

</script>

<template>
    <Head :title="'Create Employee'" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col items-start gap-4 p-8">
            <h1 class="text-2xl font-bold mb-6">Create Employee</h1>
            <form @submit.prevent="form.post('/companies')" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <Label for="firstName">First Name</Label>
                    <Input
                        id="firstName"
                        type="text"
                        v-model="form.firstName"
                        required
                    />
                    <InputError :message="form.errors.firstName" />
                </div>
                <div class="flex flex-col gap-2">
                    <Label for="lastName">Last Name</Label>
                    <Input
                        id="lastName"
                        type="text"
                        v-model="form.lastName"
                        required
                    />
                    <InputError :message="form.errors.lastName" />
                </div>
                <div class="flex flex-col gap-2">
                    <Label for="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                    />
                    <InputError :message="form.errors.email" />
                </div>
                <div class="flex flex-col gap-2">
                    <Label for="address">Address</Label>
                    <Input
                        id="address"
                        type="text"
                        v-model="form.address"
                    />
                    <InputError :message="form.errors.address" />
                </div>
                <Button 
                    type="submit"
                    class="cursor-pointer mt-4 bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-600"
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Create
                </Button>
            </form>
        </div>
    </AppLayout>
</template>