<template>
    <div class="d-inline">
        <span :class="value==1 ? 'disabled' : ''" @click="decrement()">
            <b-icon icon="dash-circle-fill"></b-icon>
        </span>
        
        <span>{{value}}</span>
        
        <span :class="value==10 ? 'disabled' : ''"  @click="increment()">
            <b-icon icon="plus-circle-fill"></b-icon>
        </span>
    </div>
</template>

<script>
import { BIcon, BIconPlusCircleFill, BIconDashCircleFill } from 'bootstrap-vue';

export default {
    name: 'NumberIncrement',
    data() {
        return {
            value: 1,
        }
    },
    props: {
        startValue: {
            type: Number,
            default: 1,
        },
        dishSlug: {
            type: String,
            default: '',
        }
    },
    watch: {
        startValue() {
            this.value = this.startValue;
        }
    },
    components: {
        BIcon,
        BIconDashCircleFill,
        BIconPlusCircleFill,
    },
    created(){
        this.value = this.startValue;
    },
    methods: {
        increment() {
            this.value++;
            this.$emit('amount', {value: this.value, dishSlug: this.dishSlug});
        },
        decrement() {
            if (this.value > 1) {
                this.value--;
            }
            this.$emit('amount', {value: this.value, dishSlug: this.dishSlug});
        }
    }
}
</script>

<style>

</style>