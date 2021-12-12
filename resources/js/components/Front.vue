<template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div class="t228__leftside" style="min-width: 417px;">
                <div class="t228__leftcontainer"><a href="/" style="color:#ffffff;text-transform:uppercase;"><img
                    src="https://static.tildacdn.com/tild3932-3534-4537-b639-303030623832/GENEZIS.svg"
                    class="t228__imglogo t228__imglogomobile" imgfield="img"
                    style="max-width: 150px; width: 150px; min-width: 150px; height: auto; display: block;"
                    alt="Генезис"></a></div>
            </div>
        </div>
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <h3 class="underline text-gray-900 dark:text-white">Создание сущности в AmoCRM</h3></div>
                    </div>

                    <SelectContainer></SelectContainer>
                    <ButtonContainer></ButtonContainer>

                </div>


                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <h3 class="underline text-gray-900 dark:text-white">Результаты:</h3></div>
                    </div>
                    <MessageContainer></MessageContainer>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import SelectContainer from './SelectContainer';
import ButtonContainer from "./ButtonContainer";
import MessageContainer from "./MessageContainer";
export default {
    name: "front",
    components: {
        ButtonContainer,
        SelectContainer,
        MessageContainer
    }
}
</script>

<style scoped>

</style>
