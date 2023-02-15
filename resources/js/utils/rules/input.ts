import {FormItemRule} from "naive-ui";

export const validationMinLength = (length: number) =>
    (rule: FormItemRule, value: string):boolean =>
        !!value && value.length >= length

export const validationMaxLength = (length: number) =>
    (rule: FormItemRule, value: string): boolean =>
        !!value && value.length <= length
