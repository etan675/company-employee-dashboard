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

const form = useForm({
    name: props.company.data.name || '',
    abn: props.company.data.abn || '',
    email: props.company.data.email || '',
    address: props.company.data.address || '',
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: props.company.data.name,
        href: `/companies/${props.company.data.id}`
    },
    {
        title: 'Edit',
        href: `/companies/${props.company.data.id}/edit`
    },
];
</script>

<template>
    <Head :title="'Edit Company Details'" />
    <AppLayout :breadcrumbs="breadcrumbs">
         <div class="flex flex-col items-start gap-4 p-8">
            <h1 class="text-2xl font-bold mb-6">Edit Company</h1>
            <form 
                @submit.prevent="form.patch(`/companies/${props.company.data.id}`)" 
                class="flex flex-col gap-4"
            >
                <div class="flex flex-col gap-2">
                    <Label for="name">Name</Label>
                    <Input
                        id="name"
                        type="text"
                        v-model="form.name"
                    />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="flex flex-col gap-2">
                    <Label for="abn">ABN</Label>
                    <Input
                        id="abn"
                        type="text"
                        v-model="form.abn"
                    />
                    <InputError :message="form.errors.abn" />
                </div>
                <div class="flex flex-col gap-2">
                    <Label for="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        v-model="form.email"
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
                    Confirm
                </Button>
            </form>
        </div>
    </AppLayout>
</template>