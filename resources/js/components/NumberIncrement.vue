<template>
    <div class="d-inline">
        <span class="input" :class="value==1 ? 'disabled' : ''" @click="decrement()">
            <b-icon icon="dash-circle-fill"></b-icon>
        </span>
        
        <span>{{getValue()}}</span>
        
        <span class="input" :class="value==10 ? 'disabled' : ''"  @click="increment()">
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
        },
        minValue: {
            type: Number,
            default: 1,
        },
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
        getValue() {
            let value = this.value;
            if(value == 0) {
               value = 1;
            }
            return value;
        },
        increment() {
            this.value++;
            this.$emit('amount', {value: this.value, dishSlug: this.dishSlug});
        },
        decrement() {
            if (this.value > this.minValue) {
                this.value--;
            }
            this.$emit('amount', {value: this.value, dishSlug: this.dishSlug});
        }
    }
}
</script>

<style lang="scss" scoped>
.input {
    cursor: pointer;
    &:hover {
        filter: opacity(0.5);
    }
}

</style>