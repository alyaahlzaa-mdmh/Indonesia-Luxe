const registerAdminUi = () => {
    if (! window.Alpine || window.__adminUiRegistered) {
        return;
    }

    window.__adminUiRegistered = true;

    window.Alpine.data('adminDebouncedModel', ({ state, delay = 500 }) => ({
        state,
        delay,
        value: '',
        timeoutId: null,

        init() {
            this.value = this.state ?? '';

            this.$watch('state', (nextValue) => {
                const normalizedValue = nextValue ?? '';

                if (normalizedValue !== this.value) {
                    this.value = normalizedValue;
                }
            });

            this.$watch('value', (nextValue) => {
                clearTimeout(this.timeoutId);

                this.timeoutId = setTimeout(() => {
                    if ((this.state ?? '') !== nextValue) {
                        this.state = nextValue;
                    }
                }, this.delay);
            });
        },
    }));

    window.Alpine.data('adminModal', ({ state }) => ({
        state,

        get show() {
            return Boolean(this.state);
        },

        close() {
            this.state = typeof this.state === 'boolean' ? false : null;
        },
    }));

    window.Alpine.data('adminCarousel', ({ slides = [], interval = 5000 }) => ({
        slides,
        interval,
        activeSlide: 0,
        timerId: null,

        init() {
            if (this.slides.length <= 1) {
                return;
            }

            this.timerId = window.setInterval(() => {
                this.next();
            }, this.interval);
        },

        next() {
            this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1;
        },

        goTo(index) {
            this.activeSlide = index;
        },
    }));

    window.Alpine.data('adminTrendChart', ({ labels = [], revenue = [], transactions = [], maxTransactions = 8 }) => ({
        chart: null,
        labels,
        revenue,
        transactions,
        maxTransactions,

        init() {
            this.$nextTick(() => {
                this.render();
            });
        },

        destroy() {
            if (this.chart) {
                this.chart.destroy();
                this.chart = null;
            }
        },

        render() {
            if (! window.Chart || ! this.$refs.canvas) {
                return;
            }

            this.destroy();

            const context = this.$refs.canvas.getContext('2d');
            const fillGradient = context.createLinearGradient(0, 0, 0, this.$refs.canvas.clientHeight || 220);
            fillGradient.addColorStop(0, 'rgba(99, 102, 241, 0.18)');
            fillGradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

            this.chart = new window.Chart(context, {
                type: 'line',
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Revenue',
                            data: this.revenue,
                            yAxisID: 'yRevenue',
                            borderColor: '#c58b2a',
                            backgroundColor: '#c58b2a',
                            pointBackgroundColor: '#c58b2a',
                            pointBorderColor: '#c58b2a',
                            pointHoverBackgroundColor: '#c58b2a',
                            pointHoverBorderColor: '#c58b2a',
                            borderWidth: 2,
                            pointRadius: 2.5,
                            pointHoverRadius: 4,
                            tension: 0.38,
                            fill: false,
                        },
                        {
                            label: 'Transaksi',
                            data: this.transactions,
                            yAxisID: 'yTransactions',
                            borderColor: '#5b63ff',
                            backgroundColor: fillGradient,
                            pointBackgroundColor: '#5b63ff',
                            pointBorderColor: '#5b63ff',
                            pointHoverBackgroundColor: '#5b63ff',
                            pointHoverBorderColor: '#5b63ff',
                            borderWidth: 2.25,
                            pointRadius: 3,
                            pointHoverRadius: 4.5,
                            tension: 0.38,
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 450,
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: false,
                            external: ({ chart, tooltip }) => {
                                this.renderTooltip(chart, tooltip);
                            },
                        },
                    },
                    layout: {
                        padding: {
                            top: 8,
                            right: 12,
                            bottom: 4,
                            left: 0,
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                color: '#eceff4',
                                borderDash: [4, 4],
                                drawBorder: false,
                                drawTicks: false,
                            },
                            border: {
                                display: false,
                            },
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 11,
                                },
                                padding: 8,
                            },
                        },
                        yTransactions: {
                            position: 'left',
                            min: 0,
                            max: this.maxTransactions,
                            grace: 0,
                            grid: {
                                color: '#eceff4',
                                borderDash: [4, 4],
                                drawBorder: false,
                                drawTicks: false,
                            },
                            border: {
                                display: false,
                            },
                            ticks: {
                                count: 5,
                                color: '#9ca3af',
                                font: {
                                    size: 11,
                                },
                                padding: 8,
                                callback: (value) => Number.isInteger(value) ? value : '',
                            },
                        },
                        yRevenue: {
                            display: false,
                            min: 0,
                            grace: '10%',
                        },
                    },
                },
            });
        },

        renderTooltip(chart, tooltip) {
            if (! this.$refs.tooltip) {
                return;
            }

            if (tooltip.opacity === 0) {
                this.$refs.tooltip.style.display = 'none';

                return;
            }

            const rows = tooltip.dataPoints.map((dataPoint) => {
                const color = dataPoint.dataset.borderColor;
                const value = this.formatValue(dataPoint.raw);

                return `
                    <div class="flex items-center justify-between gap-5">
                        <div class="flex items-center gap-2">
                            <span class="inline-block size-2 rounded-full" style="background-color: ${color};"></span>
                            <span class="text-xs text-slate-500">${dataPoint.dataset.label}</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-900">${value}</span>
                    </div>
                `;
            }).join('');

            this.$refs.tooltip.innerHTML = `
                <div class="space-y-2">
                    <p class="text-xs font-medium text-slate-400">${tooltip.title?.[0] ?? ''}</p>
                    <div class="space-y-1.5">${rows}</div>
                </div>
            `;
            this.$refs.tooltip.style.display = 'block';

            const tooltipWidth = this.$refs.tooltip.offsetWidth;
            const tooltipHeight = this.$refs.tooltip.offsetHeight;
            const left = chart.canvas.offsetLeft + tooltip.caretX + 18;
            const top = chart.canvas.offsetTop + tooltip.caretY - (tooltipHeight / 2);
            const maxLeft = chart.canvas.offsetLeft + chart.canvas.clientWidth - tooltipWidth - 8;
            const maxTop = chart.canvas.offsetTop + chart.canvas.clientHeight - tooltipHeight - 8;

            this.$refs.tooltip.style.left = `${Math.max(chart.canvas.offsetLeft + 8, Math.min(left, maxLeft))}px`;
            this.$refs.tooltip.style.top = `${Math.max(chart.canvas.offsetTop + 8, Math.min(top, maxTop))}px`;
        },

        formatValue(value) {
            return new Intl.NumberFormat('id-ID', {
                maximumFractionDigits: 0,
            }).format(Number(value) || 0);
        },
    }));
};

document.addEventListener('alpine:init', registerAdminUi);
registerAdminUi();
