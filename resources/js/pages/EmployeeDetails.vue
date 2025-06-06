
<script setup lang="ts">
import { Head,  } from '@inertiajs/vue3';
import { Company, Employee, type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    employee: {
        data: Employee
    },
    company: {
        data: Company
    }
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: props.company.data.name,
        href: '/companies/' + props.company.data.id,
    },
    {
        title: props.employee.data.firstName + ' ' + props.employee.data.lastName,
        href: '/companies/' + props.company.data.id + '/employees/' + props.employee.data.id,
    }
];

</script>

<template>
    <Head :title="props.employee.data.firstName + ' ' + props.employee.data.lastName" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-start gap-4 p-8">
            <h1 class="text-xl font-bold">Employee Details</h1>
            <div>
                <span class="font-semibold">First Name:</span>
                <span class="ml-2">{{ props.employee.data.firstName }}</span>
            </div>
            <div>
                <span class="font-semibold">Last Name:</span>
                <span class="ml-2">{{ props.employee.data.lastName }}</span>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <span class="ml-2">{{ props.employee.data.email }}</span>
            </div>
            <div>
                <span class="font-semibold">Address:</span>
                <span class="ml-2">{{ props.employee.data.address }}</span>
            </div>
        </div> 
    </AppLayout>

</template>