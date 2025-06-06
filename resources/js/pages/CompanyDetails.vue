
<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Company, type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';

const props = defineProps<{
    company: {
        data: Company
    },
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
];

const deleteEmployee = (id: number) => {
    router.delete(`/companies/${props.company.data.id}/employees/${id}`);
}

</script>

<template>
    <Head :title="props.company.data.name" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-start gap-4 p-8">
            <h1 class="text-xl font-bold">Company Details</h1>
            <Link 
                :href="`/companies/${props.company.data.id}/edit`"
                class="bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-600"
            >
                Edit
            </Link>
            <div>
                <span class="font-semibold">Name:</span>
                <span class="ml-2">{{ props.company.data.name }}</span>
            </div>
            <div>
                <span class="font-semibold">ABN:</span>
                <span class="ml-2">{{ props.company.data.abn }}</span>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <span class="ml-2">{{ props.company.data.email }}</span>
            </div>
            <div>
                <span class="font-semibold">Address:</span>
                <span class="ml-2">{{ props.company.data.address }}</span>
            </div>
            <div class="flex flex-col gap-4">
                <h2>
                    <span class="font-semibold">Current Employees List</span>
                    <span class="text-sm text-gray-500 ml-1">(Click an employee name to view details)</span>
                </h2>
                <Link
                    :href="`/companies/${props.company.data.id}/employees/new`"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-600 self-start"
                >
                    Create New
                </Link>
                <div class="flex flex-col gap-2">
                    <div
                        v-for="employee in props.company.data.employees" 
                        :key="employee.id"
                        class="flex justify-between items-center gap-4"
                    >
                         <Link
                            :href="`/companies/${props.company.data.id}/employees/${employee.id}`"
                            class="text-sm hover:underline"
                        >
                            {{ employee.firstName }} {{ employee.lastName }} ({{ employee.email }})
                        </Link>
                        <Button
                            @click="deleteEmployee(employee.id)"
                            :variant="'destructive'"
                            class="px-2 py-1 rounded-lg cursor-pointer text-sm"
                        >
                            Delete
                        </Button>
                    </div>
                </div>
            </div>
        </div> 
    </AppLayout>
</template>